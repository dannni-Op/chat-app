const chatBox = document.getElementById("chat");
let countChat = document.querySelectorAll("#message").length;

const senderId = document.getElementById("sender").value;
const recipientId = document.getElementById("recipient").value;

const xml = new XMLHttpRequest();

chatBox.scrollTop = chatBox.scrollHeight;
setInterval(() => {
  xml.onreadystatechange = () => {
    if( xml.readyState == XMLHttpRequest.DONE) {
      if( xml.status == 200 ) {
        const response = JSON.parse(xml.responseText);
        if( response.length > countChat ){
          //render chat
          let messages = '';  
          response.forEach( e => {

            if( e.senderId == senderId ){
              const temp = `<div id='message' class="flex items-start gap-2.5 justify-end" >
              <img class="w-12 rounded-full" src="http://localhost:8080/images/dummy.jpg" alt="">
              <div class="flex flex-col w-[220px] leading-1.5 p-4 border-gray-200 bg-gray-100 rtl:bg-indigo-600 rounded-e-xl rounded-es-xl shadow-md">
              <div class="flex items-center space-x-2 rtl:space-x-reverse">
              <span class="text-xs font-semibold text-white">Bonnie Green</span>
              <span class="text-xs font-normal text-white">11:46</span>
              </div>
              <p class="text-sm font-normal py-2.5 text-white">${e.messageText}</p>
              </div>
              </div>`;

              messages += temp;
            } else {
              const temp = `<div id='message' class="flex items-start gap-2.5 justify-start">
              <img class="w-12 rounded-full" src="http://localhost:8080/images/dummy.jpg" alt="">
              <div class="flex flex-col w-[220px] leading-1.5 p-4 border-gray-200 bg-white rounded-e-xl rounded-es-xl shadow-md">
              <div class="flex items-center space-x-2 rtl:space-x-reverse">
              <span class="text-xs font-semibold text-gray-900">Bonnie Green</span>
              <span class="text-xs font-normal text-gray-500">11:46</span>
              </div>
              <p class="text-sm font-normal py-2.5 text-gray-900 ">${e.messageText}</p>
              </div>
              </div>`;

              messages += temp;
            }

            chatBox.innerHTML = messages;
            chatBox.scrollTop = chatBox.scrollHeight;
            countChat = document.querySelectorAll("#message").length;
          });
        }
      }
    }
  }

  xml.open("GET", `http://localhost:8080/api/messages?senderId=${senderId}&recipientId=${recipientId}`);
  xml.send();

}, 2000);
