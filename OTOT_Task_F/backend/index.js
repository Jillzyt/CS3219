const express = require('express')
const app = express()
const port = 3004
const { Client } = require('pg')
const redis = require("redis");
const redisClient = redis.createClient();

redisClient.on("error", function(error) {
    console.error(error);
});

const client = new Client({
    user: 'postgres',
    host: '127.0.0.1',
    database: 'OTOT_Task_F',
    password: 'Test1234',
    port: 5432,
})

client.connect()

// Reset the key
app.get('/deletekey', async(req, res) => {
    await redisClient.del("key", function(err, reply) {
        res.send("Cleared key");
    });
    await redisClient.get("key", function(err, reply) {
        console.log(reply == null ? "Key is null" : "Key is not null");
    });
})

// To implement redis
app.get('/redis', async(req, res) => {
    // Check whether there is existing key
    await redisClient.get("key", async function(err, reply) {
        if (reply != null) {
            console.log("There is key")
            res.send(reply.toString())
        } else {
            // If do not have, set items for key again
            console.log("Setting items for key")
            const items = await client.query('SELECT * FROM tiles');
            await redisClient.set("key", JSON.stringify(items.rows), function(err, reply) {
                console.log(err)
                res.send(JSON.stringify(items.rows))
                console.log("Set items for key")
            })
        }
    });
})

// Time test without redis
app.get('/', async(req, res) => {
    const items = await client.query('SELECT * FROM tiles');
    res.send(JSON.stringify(items.rows))
})

app.listen(port, () => {
    console.log(`Example app listening at http://localhost:${port}`)
})