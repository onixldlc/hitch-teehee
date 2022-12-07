const fetch = require('node-fetch');

let host = process.env.PHP_HOST


async function test(){
    let isAuthed = ""
    try{
        isAuthed = await fetch(`http://${host}/api/internalCalls/authMessage.php`, {
            method:"POST",
            body:JSON.stringify({"userid":"143af93018ef02a5c89ffb63a8d4bd03939ba895e383afd65e6e4723bc357e20"})
        })
        .then(data=>data.text());
    }catch(e){
        console.log(e);
    }
    console.log(isAuthed);
}
test();