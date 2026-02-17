---
trigger: always_on
---

# Controller–Model Query Separation Rule

## Scope

Applies to PHP CodeIgniter controllers and models.

## Objective

Ensure all database queries are executed in models, not in controllers, to enforce separation of concerns, reusability, and maintainability.

---

## Mandatory Rules

1. **No Direct Queries in Controllers**
   - Controllers must not contain:
     - `$this->db->select()`
     - `$this->db->where()`
     - `$this->db->join()`
     - `$this->db->get()`
     - `$this->db->insert()`
     - `$this->db->update()`
     - `$this->db->delete()`
   - Exception: transaction control only (`trans_start`, `trans_complete`) if already present.

2. **Queries Must Be Moved to Models**
   - All database logic must be encapsulated inside a model method.
   - The controller must call a clearly named model function.

---

## Refactoring Rules

3. **Check Existing Model Methods First (Mandatory)**
   - Before creating a new model method:
     - Scan the target model for existing functions.
     - Reuse an existing method if it already performs the same or equivalent query.
   - Do not create duplicate methods with overlapping responsibilities.

4. **Avoid Method Name Collisions**
   - When creating a new method:
     - Ensure the method name does not already exist in the model.
     - Do not overwrite or rename existing methods unless explicitly instructed.

5. **Readable Model Method Naming**
   - Model method names must describe business intent, not SQL behavior.

   **Example**

   ```php
   getOriginalMovement($rs_no, $product_id)
   ```
