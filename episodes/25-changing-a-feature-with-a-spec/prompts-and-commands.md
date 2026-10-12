# Episode 25: prompts and commands

Typed prompts, commands and small snippets shown in this episode, copied from the episode script. Output is not shown.

## Prompts (typed in the Claude Code chat)

```text
/opsx:propose Lower the free shipping threshold from 50.00 to 40.00. Keep the 4.99 fee and everything else the same.
```

## Snippet

```text
/clear
/opsx:apply lower-free-shipping-threshold
```

## Snippet

```text
Use playwright to open http://localhost:3000, add items until the cart total is 32.00, and check that the summary shows Shipping 4.99 and the message Add 8.00 more for free shipping. Then add items until the total is 60.00 and check that it shows Shipping Free with no message. Use snapshots to read the page and report any console errors.
```

## Snippet

```text
/opsx:archive lower-free-shipping-threshold
```

## Commands (typed in the terminal; no output shown)

```text
openspec validate lower-free-shipping-threshold --strict
openspec show lower-free-shipping-threshold --diff
npm test
openspec show shipping --type spec
```

