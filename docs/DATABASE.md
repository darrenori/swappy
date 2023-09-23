# Database

Schema and seed data are in mydb.sql. Import into a database called mydb.

The data groups into accounts and auth (hashed password, username, email, user type, the
Google Authenticator secret), the catalogue (stores, products, types, variants, each
variant with its own stock count), carts and orders (cart lines that become orders tied to
a shipping address), reviews (with replies, likes and dislikes), notifications, and the HR
side (staff, tasks with a status, attendance, leave and pay). The admin log is its own
table, one row per action with the file and the IP. Most tables link back to a user or a
store.
