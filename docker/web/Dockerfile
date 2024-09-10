FROM node:22-alpine3.19

# Set up default directory
WORKDIR /var/www/web

# Configure host
ENV HOST 0.0.0.0

# Activate pnpm package manager
RUN corepack enable
RUN corepack prepare pnpm@latest --activate

# Init command
CMD ["sh", "-c", "pnpm install && pnpm run dev"]
