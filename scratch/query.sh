#!/bin/bash
docker compose exec -T postgres psql -U n8n_user -d n8n_db -t -A -c 'SELECT data FROM execution_data WHERE "executionId" = (SELECT MAX("executionId") FROM execution_data);' > scratch/execution_latest_utf8.json
