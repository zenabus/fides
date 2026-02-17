<?php

class Hdf_utility_helper_test extends TestCase {
  public function setUp(): void {
    $this->resetInstance();
    $this->CI->load->helper('hdf_utility');
  }

  public function test_datesBetween_returns_correct_range() {
    $start = '2026-02-01';
    $end = '2026-02-03';

    $result = datesBetween($start, $end, 'Y-m-d');

    // Should contain Feb 1 and Feb 2. End date is excluded in this logic (checkout date).
    $this->assertContains('2026-02-01', $result);
    $this->assertContains('2026-02-02', $result);
    $this->assertNotContains('2026-02-03', $result);
    $this->assertCount(2, $result);
  }

  public function test_determinePeriod_returns_am_or_pm() {
    // Since determinePeriod uses date('H:i:s'), it is hard to test deterministically without mocking time.
    // However, we can assert the return type and value set.
    $result = determinePeriod();
    $this->assertContains($result, ['am', 'pm']);
  }
}
