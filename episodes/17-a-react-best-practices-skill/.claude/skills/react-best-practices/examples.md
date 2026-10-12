# Examples

## Calculate, don't store
Avoid: a fullName state variable kept in sync by an Effect.
Prefer: const fullName = firstName + ' ' + lastName; during render.

## Event handler, not Effect
Avoid: setting a "submitted" flag, then sending the order from an Effect.
Prefer: send the order inside the Submit button's click handler.

## Stable keys
Avoid: key={index} on a cart list where items can be removed.
Prefer: key={item.id}.

## Replace, don't mutate
Avoid: cart.items.push(item); then setCart(cart);
Prefer: setCart({ ...cart, items: [...cart.items, item] });

## No nested component definitions
Avoid: defining a CartRow function inside the CartList function.
Prefer: define CartRow at the top level of the module and render it from CartList.
