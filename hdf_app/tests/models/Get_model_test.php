<?php

class Get_model_test extends TestCase {
  public function setUp(): void {
    $this->resetInstance();
    $this->CI->load->model('Get_model');
    $this->obj = $this->CI->Get_model;
  }

  public function test_checkAvailabilityInRange_returns_bookings() {
    // ARRANGE: Insert a test booking
    $booking_data = [
      'booking_number' => 'TEST001',
      'guest_id' => 1,
      'reservation_status' => 1, // Confirmed
      'arrival' => '2026-05-01',
      'departure' => '2026-05-05'
    ];
    $this->CI->db->insert('bookings', $booking_data);
    $booking_id = $this->CI->db->insert_id();

    $booked_room_data = [
      'booking_id' => $booking_id,
      'room_id' => 101, // Assuming room 101 exists or is created
      'check_in' => '2026-05-01',
      'check_out' => '2026-05-05',
      'booked_room_archived' => 0
    ];
    $this->CI->db->insert('booked_rooms', $booked_room_data);

    // ACT: Check for overlap
    // Overlap: 2026-05-04 to 2026-05-06 (Overlaps on 4th and 5th)
    $result = $this->obj->checkAvailabilityInRange('2026-05-04', '2026-05-06');

    // ASSERT
    $this->assertNotEmpty($result, 'Should return the conflicting booking');
    $this->assertEquals($booking_id, $result[0]['booking_id']);

    // CLEANUP (Implicit rollback if DbTestCase is used, but TestCase might not. 
    // ci-phpunit-test TestCase doesn't auto-rollback DB unless using specific traits or logic. 
    // Safer to just delete for this specific test if not using DbTestCase)
    $this->CI->db->where('booking_id', $booking_id)->delete('booked_rooms');
    $this->CI->db->where('booking_id', $booking_id)->delete('bookings');
  }

  public function test_checkAvailabilityInRange_no_overlap() {
    // ARRANGE: Insert a test booking
    $booking_data = [
      'booking_number' => 'TEST002',
      'guest_id' => 1,
      'reservation_status' => 1,
      'arrival' => '2026-05-01',
      'departure' => '2026-05-05'
    ];
    $this->CI->db->insert('bookings', $booking_data);
    $booking_id = $this->CI->db->insert_id();

    $booked_room_data = [
      'booking_id' => $booking_id,
      'room_id' => 101,
      'check_in' => '2026-05-01',
      'check_out' => '2026-05-05',
      'booked_room_archived' => 0
    ];
    $this->CI->db->insert('booked_rooms', $booked_room_data);

    // ACT: Check matching range strictly outside
    // New booking: 2026-05-05 to 2026-05-10
    // Existing check_out is 2026-05-05. Logic is check_in < end AND check_out > start.
    // 2026-05-01 < 2026-05-10 (True) AND 2026-05-05 > 2026-05-05 (False) -> No overlap
    $result = $this->obj->checkAvailabilityInRange('2026-05-05', '2026-05-10');

    // ASSERT
    // We need to filter result to ensure we don't pick up other random bookings from DB
    $found = false;
    foreach ($result as $row) {
      if ($row['booking_id'] == $booking_id) {
        $found = true;
        break;
      }
    }
    $this->assertFalse($found, 'Should NOT find the booking as dates touch but do not overlap');

    // CLEANUP
    $this->CI->db->where('booking_id', $booking_id)->delete('booked_rooms');
    $this->CI->db->where('booking_id', $booking_id)->delete('bookings');
  }

  public function test_getCheckInCount_AM() {
    // ARRANGE: Create a booking and insert room check-ins at various times
    $booking_data = [
      'booking_number' => 'TEST_CI_AM',
      'guest_id' => 1,
      'reservation_status' => 0, // Active
      'arrival' => '2026-05-22',
      'departure' => '2026-05-23'
    ];
    $this->CI->db->insert('bookings', $booking_data);
    $booking_id = $this->CI->db->insert_id();

    // Check-in inside AM shift (May 22, 10:00 AM)
    $room_am1 = [
      'booking_id' => $booking_id,
      'room_id' => 101,
      'check_in' => '2026-05-22',
      'check_out' => '2026-05-23',
      'booked_room_archived' => 0,
      'booked_room_added' => '2026-05-22 10:00:00'
    ];
    $this->CI->db->insert('booked_rooms', $room_am1);

    // Check-in inside AM shift boundary (Previous day May 21, 11:00 PM)
    $room_am2 = [
      'booking_id' => $booking_id,
      'room_id' => 102,
      'check_in' => '2026-05-22',
      'check_out' => '2026-05-23',
      'booked_room_archived' => 2, // Checked-out (should still be counted)
      'booked_room_added' => '2026-05-21 23:00:00'
    ];
    $this->CI->db->insert('booked_rooms', $room_am2);

    // Check-in inside PM shift (May 22, 3:00 PM) - should NOT be counted in AM
    $room_pm = [
      'booking_id' => $booking_id,
      'room_id' => 103,
      'check_in' => '2026-05-22',
      'check_out' => '2026-05-23',
      'booked_room_archived' => 0,
      'booked_room_added' => '2026-05-22 15:00:00'
    ];
    $this->CI->db->insert('booked_rooms', $room_pm);

    // ACT
    $count = $this->obj->getCheckInCount('2026-05-22', 'AM');

    // ASSERT
    $this->assertGreaterThanOrEqual(2, $count, 'Should count the two AM check-ins');

    // CLEANUP
    $this->CI->db->where('booking_id', $booking_id)->delete('booked_rooms');
    $this->CI->db->where('booking_id', $booking_id)->delete('bookings');
  }

  public function test_getCheckInCount_PM() {
    // ARRANGE: Create a booking and insert room check-ins
    $booking_data = [
      'booking_number' => 'TEST_CI_PM',
      'guest_id' => 1,
      'reservation_status' => 0,
      'arrival' => '2026-05-22',
      'departure' => '2026-05-23'
    ];
    $this->CI->db->insert('bookings', $booking_data);
    $booking_id = $this->CI->db->insert_id();

    // Check-in inside PM shift (May 22, 4:00 PM)
    $room_pm1 = [
      'booking_id' => $booking_id,
      'room_id' => 101,
      'check_in' => '2026-05-22',
      'check_out' => '2026-05-23',
      'booked_room_archived' => 0,
      'booked_room_added' => '2026-05-22 16:00:00'
    ];
    $this->CI->db->insert('booked_rooms', $room_pm1);

    // Check-in inside AM shift (May 22, 9:00 AM) - should NOT be counted in PM
    $room_am = [
      'booking_id' => $booking_id,
      'room_id' => 102,
      'check_in' => '2026-05-22',
      'check_out' => '2026-05-23',
      'booked_room_archived' => 0,
      'booked_room_added' => '2026-05-22 09:00:00'
    ];
    $this->CI->db->insert('booked_rooms', $room_am);

    // ACT
    $count = $this->obj->getCheckInCount('2026-05-22', 'PM');

    // ASSERT
    $this->assertGreaterThanOrEqual(1, $count, 'Should count the PM check-in');

    // CLEANUP
    $this->CI->db->where('booking_id', $booking_id)->delete('booked_rooms');
    $this->CI->db->where('booking_id', $booking_id)->delete('bookings');
  }
}
