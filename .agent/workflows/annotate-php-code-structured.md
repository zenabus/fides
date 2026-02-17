---
description: Annotates existing PHP code with short, structured, business-focused comments for maintainability and audit clarity.
---

## Inputs

- PHP source code

## Output

- Same PHP code with structured comments added
- No logic changes
- No explanations outside the code

## Workflow Steps

### Step 1: Analyze Code

- Read the full code block.
- Identify validations, conditionals, loops, and database operations.

### Step 2: Identify Major Business Flows

- Detect mutually exclusive paths (e.g., Admin vs Mobile, With Order vs No Order).
- Assign each flow a capital letter (A, B, C).

### Step 3: Insert Section Headers

- Add mandatory section headers before each major flow using the approved format.

### Step 4: Annotate Sub-Steps

- Within each section:
  - Number logical steps sequentially (1, 2, 3).
  - Use short, action-oriented comments.

### Step 5: Annotate Validations

- Explain why the validation exists.
- Mention enforcing role when applicable.

### Step 6: Final Review

- Verify no logic was changed.
- Remove redundant or obvious comments.
- Ensure enumeration consistency.

## Output Rules

- Output only the commented PHP code.
- Do not include markdown formatting.
- Do not include explanations or summaries.
