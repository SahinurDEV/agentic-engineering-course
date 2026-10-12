# A four-part prompt template

Assembled from the slides in Episode 6. For a small fix, one sentence per part is enough.

1. **Goal**: what is true when it is done.
2. **Context**: files, symptom, error, pattern to follow.
3. **Constraints**: rules, and what not to do.
4. **Verification**: how it checks its own work.

## Example (cart project, from the "with tests" slide)

```text
add SAVE20 (20% off). Test a normal cart, an empty cart, and a total under the discount.
Run npm test and fix any failures.
```
