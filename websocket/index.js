const WebSocket = require('ws');
const fs = require('fs');
const jwt = require('jsonwebtoken');
const dotenv = require('dotenv');

dotenv.load();

const jwtKey = fs.readFileSync(process.env.WS_JWT_PUBLIC_KEY);
const server = new WebSocket.Server({ port: 8000 });

server.on('connection', function (ws, request) {

    console.log('connected: %s', request.connection.remoteAddress);

    ws.on('message', function (message) {

        console.log('received: %s', message);

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
    });
});