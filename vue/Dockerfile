FROM node:lts-alpine

WORKDIR /app 

RUN npm install -g @vue/cli

COPY package.json .
COPY package-lock.json .

RUN npm install

COPY . .

CMD ["npm", "run", "serve"]
