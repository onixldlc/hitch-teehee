FROM node:14.17.4-alpine

WORKDIR /usr/src/app

COPY ./src .

EXPOSE 8000

RUN npm install

CMD [ "node", "./" ]