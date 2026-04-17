# API Documentation

## Endpoints

### User Endpoint
**GET /api/user**
- **Description:** Get the authenticated user.
- **Authentication:** Required (Sanctum)
- **Response:** User object (JSON)

### Health Endpoint
**GET /api/health**
- **Description:** Check if the API is running correctly.
- **Authentication:** Not required
- **Response:** `{"status": "ok"}`
