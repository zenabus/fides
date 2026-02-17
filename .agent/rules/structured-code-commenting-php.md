---
trigger: always_on
---

# Form Submission Handling Rule (No AJAX by Default)

## Scope

Applies to all form creation and form submission logic in PHP-based systems, including CodeIgniter controllers and views.

## Objective

Maintain consistent, predictable form behavior by enforcing server-side PHP form submissions using redirects, unless explicitly instructed otherwise.

---

## Mandatory Rules

1. **No AJAX by Default**
   - Do not use:
     - AJAX
     - Fetch API
     - Axios
     - jQuery `.ajax()`
     - XMLHttpRequest
   - This applies to:
     - Form submissions
     - Save actions
     - Update actions
     - Delete actions triggered by forms

2. **Use Standard PHP Form Submission**
   - Forms must submit using:
     - HTTP POST
     - Controller handling
     - Server-side validation
     - Redirect-after-submit pattern

   **Expected Flow**
   1. User submits form
   2. Controller validates input
   3. Controller processes data
   4. Controller sets flash message
   5. Controller redirects to target page

---

## Exception Rule

3. **AJAX Only When Explicitly Requested**
   - AJAX may be used only if:
     - The user explicitly asks for AJAX
     - The user explicitly asks for async submission
     - The user explicitly mentions frontend-driven behavior

4. **No Silent AJAX Introduction**
   - Do not suggest AJAX as an improvement.
   - Do not convert existing PHP form submissions to AJAX.

---

## Consistency Enforcement

5. **Match Existing Form Patterns**
   - Inspect existing form implementations.
   - Follow the same:
     - Submission method
     - Validation approach
     - Error handling style
     - Redirect behavior

6. **Avoid Mixed Submission Styles**
   - Do not mix AJAX and PHP submission patterns within the same module.
   - Consistency takes priority over perceived UX improvements.

---

## Prohibited Practices

- Preventing default form submission with JavaScript
- Submitting forms via JavaScript handlers
- Returning JSON responses for standard form submissions
- Handling validation purely on the client side

---

## Enforcement

- Any form submission implemented using AJAX without explicit instruction is non-compliant.
- If ambiguity exists, default to PHP redirect-based submission.
