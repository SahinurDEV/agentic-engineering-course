# Episode 24: prompts and commands

Typed prompts, commands and small snippets shown in this episode, copied from the episode script. Output is not shown.

## Prompts (typed in the Claude Code chat)

```text
/opsx:propose Free shipping when the cart total after discounts is 50.00 or more, otherwise a flat fee of 4.99. Show the shipping line in the cart summary and how much more is needed for free shipping.
```

## Snippet

```text
/clear
/opsx:apply add-free-shipping
```

## Snippet

```text
Use playwright to open http://localhost:3000, add items until the cart total is 42.00, and check that the summary shows Shipping 4.99 and the message Add 8.00 more for free shipping. Then add items until the total is over 50.00 and check that it shows Shipping Free with no free shipping message. Use snapshots to read the page. Save a screenshot as free-shipping-check.png and report any console errors.
```

## Snippet

```text
/opsx:archive add-free-shipping
```

## Commands (typed in the terminal; no output shown)

```text
openspec validate add-free-shipping --strict
git add openspec/changes/add-free-shipping
git commit -m "Plan: add free shipping"
npm test
openspec list --specs
openspec show shipping --type spec
openspec validate --all --strict
```

