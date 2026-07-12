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
}
