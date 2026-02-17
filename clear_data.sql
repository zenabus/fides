SET FOREIGN_KEY_CHECKS = 0;

-- Transactional Data (Verified from Insert_model.php usage)
TRUNCATE TABLE bookings;
TRUNCATE TABLE booked_rooms;
TRUNCATE TABLE booking_payment;
TRUNCATE TABLE booking_refund;
TRUNCATE TABLE booking_logs;
TRUNCATE TABLE user_logs;
TRUNCATE TABLE checkouts;
TRUNCATE TABLE charges_food;
TRUNCATE TABLE charges_other;
TRUNCATE TABLE remittances;
TRUNCATE TABLE sales;
TRUNCATE TABLE collectables;
TRUNCATE TABLE cash;
TRUNCATE TABLE expenses;
TRUNCATE TABLE payment;

-- Optional: Reset Cash Float if removed
-- INSERT INTO cash (cash_amount) VALUES (0);

SET FOREIGN_KEY_CHECKS = 1;

-- Tables Preserved (Master Data / Config):
-- users
-- guests
-- rooms
-- room_type
-- prices
-- discounts
-- categories
-- charges
-- room_statuses
