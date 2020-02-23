const WebSocket = require('ws');
const fs = require('fs');
const jwt = require('jsonwebtoken');
const dotenv = require('dotenv');
const kafka = require('kafka-node');

dotenv.load();

const jwtKey = fs.readFileSync(process.env.WS_JWT_PUBLIC_KEY);
const server = new WebSocket.Server({ port: 8000 });

server.on('connection', function (ws, request) {

    console.log('connected: %s', request.connection.remoteAddress);

    ws.on('message', function (message) {

        const data = JSON.parse(message);

        if (data.type && data.type === 'auth') {
            try {
                const token = jwt.verify(data.token, jwtKey, {algorithms: ['RS256']});
                console.log('user_id: %s', token.sub);
                ws.user_id = token.sub;
            } catch (err) {
                console.log(err);
            }
        }


        const client = new kafka.KafkaClient({
            kafkaHost: process.env.WS_KAFKA_BROKER_LIST
        });

        const consumer = new kafka.Consumer(
            client,
            [
                {topic: 'notifications', partition: 0}
            ], {
                groupId: 'websocket'
            }
        );

        consumer.on('message', function (message) {
            console.log('consumed: %s', message.value);
            const value = JSON.parse(message.value);
            server.clients.forEach(ws => { if (ws.user_id === value.user_id) ws.send(message.value) })
        });

    });
});