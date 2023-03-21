FROM node:lts-alpine

#RUN yarn global add @vue/cli

RUN npm install -g http-server
RUN mkdir /app
WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .
RUN npm run build


CMD ["http-server","dist"]