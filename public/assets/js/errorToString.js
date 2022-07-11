function errorToString(message) {
    let errorMessages = `${message.message}`;
    if(message.errors.file){
        message.errors.file.forEach((error)=>{
            errorMessages = errorMessages + `\n ${error}`
        });
    }
    return errorMessages;
}

function errorArrayToString(message) {
    let errorMessages = `The given data was invalid`;
    message.forEach((error)=>{
        errorMessages = errorMessages + `\n ${error}`
    });
    return errorMessages;
}