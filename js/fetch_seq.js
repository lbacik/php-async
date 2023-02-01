const fetch = require('node-fetch')

const sleepingUrl = process.env.SLEEPING_URL || 'http://localhost:3000'

const sequenceStart = process.argv[2] || 0 
const sequenceStop = process.argv[3] || 3

console.log(`Sequence: ${sequenceStart} .. ${sequenceStop}`)

for (let i=sequenceStart; i<=sequenceStop; i++) {
    fetch(`${sleepingUrl}/${i}`)
        .then(response => response.text())
        .then(result => console.log(result))
}

console.log('end')

