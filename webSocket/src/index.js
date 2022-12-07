const app = require('http').createServer(server);
const fetch = require('node-fetch');
const io = require('socket.io')(app, {
    cors: {
        origin:"*"
    }
});

function server(req, res){
    res.writeHead(200);
    res.end("socket.io server is running !")
}

app.listen(8000);

// console.log(process.env)

let host = process.env.PHP_HOST


// function saveMessage(data){

//     let url = protocol+host+path
//     fetch(url, {
//         method: 'POST',
//         body: JSON.stringify(data)
//     })
// }

io.on('connection', (socket) => {
    // socket.on('loadMessage',(thread)=>{
    //     var message = [];
    //     if(thread != 'global'){
    //         message = db.findMessageFromThread(thread)
    //     }
    //     io.emit('loadMessage')
    // })

    socket.on('message', async(json) => {
            console.log(json);
            // if(json.thread != "global" && json.thread != 'Global' ){
            //     saveMessage(json)
            // }
            let isAuthed={};
            if(json.userid && json.userid != "guest"){
                let data={"userid":json.userid};
                try{
                    isAuthed = await fetch(`http://${host}/api/internalCalls/authMessage.php`, {
                        method:"POST",
                        body:JSON.stringify(data)
                    })
                    .then(data=>data.json());
                }catch(e){
                    console.log(e);
                }
            }


            if(json.username.includes("guest")){
                isAuthed["status"]="success"
            }

            if(isAuthed.status=="success"){
                io.emit('message',{"timestamp":json.timestamp,"username":json.username,"message":json.message,"color":json.color,"thread":json.thread} );
            }
    });
});
