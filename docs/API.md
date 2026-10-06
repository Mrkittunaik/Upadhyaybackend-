# API reference

Base: `/api/v1`. Envelope: `{ "success": bool, "message": str, "data": ..., "errors": ..., "meta": ... }`.
Auth: `Authorization: Bearer <token>`. Pagination: `?page=1&per_page=20`.

## Available in Part 1
### GET /api/v1/health
Auth: none. Returns `{app, time}`.

Parts 2 and 3 document each endpoint (method, auth, role, params, body, validation, responses, errors).
