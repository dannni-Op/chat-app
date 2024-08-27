<main class="sm:mx-auto sm:w-full sm:max-w-md h-screen grid grid-rows-[80px_1fr_auto]">
  <div class="flex justify-between items-center p-1 border bg-indigo-600 px-4">
    <div class="flex items-center justify-between w-full" >
      <a href="http://localhost:8080/chats">Back</a>
      <div class="" >
        <p class="text-sm text-center"><?= $params["user"]->firstname . " " . $params["user"]->lastname; ?></p>
        <p class="text-xs text-center"><?= $params["user"]->status; ?></p>
      </div>
      <div class="w-12 h-12 rounded-full overflow-hidden">
        <img class="" src="http://localhost:8080/images/dummy.jpg" alt="profil" />
      </div>
    </div>
  </div>
  <div class="py-3 flex flex-col justify-between gap-4 overflow-auto px-2 bg-slate-100">
    <div class="flex items-start gap-2.5">
      <img class="w-12 rounded-full" src="http://localhost:8080/images/dummy.jpg" alt="">
      <div class="flex flex-col w-[220px] leading-1.5 p-4 border-gray-200 bg-white rounded-e-xl rounded-es-xl shadow-md">
        <div class="flex items-center space-x-2 rtl:space-x-reverse">
          <span class="text-xs font-semibold text-gray-900">Bonnie Green</span>
          <span class="text-xs font-normal text-gray-500">11:46</span>
        </div>
        <p class="text-sm font-normal py-2.5 text-gray-900 ">That's awesome. I think our users will really appreciate the improvements.</p>
      </div>
    </div>
    <div class="flex items-start gap-2.5" dir="rtl">
      <img class="w-12 rounded-full" src="http://localhost:8080/images/dummy.jpg" alt="">
      <div class="flex flex-col w-[220px] leading-1.5 p-4 border-gray-200 bg-gray-100 rtl:bg-indigo-600 rounded-e-xl rounded-es-xl shadow-md">
        <div class="flex items-center space-x-2 rtl:space-x-reverse">
          <span class="text-xs font-semibold text-gray-900 rtl:text-white">Bonnie Green</span>
          <span class="text-xs font-normal text-gray-500 rtl:text-white">11:46</span>
        </div>
        <p class="text-sm font-normal py-2.5 text-gray-900 rtl:text-white">That's awesome. I think our users will really appreciate the improvements.</p>
      </div>
    </div>
    <div class="flex items-start gap-2.5">
      <img class="w-12 rounded-full" src="http://localhost:8080/images/dummy.jpg" alt="">
      <div class="flex flex-col w-[220px] leading-1.5 p-4 border-gray-200 bg-white rounded-e-xl rounded-es-xl shadow-md">
        <div class="flex items-center space-x-2 rtl:space-x-reverse">
          <span class="text-xs font-semibold text-gray-900">Bonnie Green</span>
          <span class="text-xs font-normal text-gray-500">11:46</span>
        </div>
        <p class="text-sm font-normal py-2.5 text-gray-900 ">That's awesome. I think our users will really appreciate the improvements.</p>
      </div>
    </div>
    <div class="flex items-start gap-2.5" dir="rtl">
      <img class="w-12 rounded-full" src="http://localhost:8080/images/dummy.jpg" alt="">
      <div class="flex flex-col w-[220px] leading-1.5 p-4 border-gray-200 bg-gray-100 rtl:bg-indigo-600 rounded-e-xl rounded-es-xl shadow-md">
        <div class="flex items-center space-x-2 rtl:space-x-reverse">
          <span class="text-xs font-semibold text-gray-900 rtl:text-white">Bonnie Green</span>
          <span class="text-xs font-normal text-gray-500 rtl:text-white">11:46</span>
        </div>
        <p class="text-sm font-normal py-2.5 text-gray-900 rtl:text-white">That's awesome. I think our users will really appreciate the improvements.</p>
      </div>
    </div>
  </div>
  <div class="border h-full w-full self-end py-4">
    <div class="pt-2 text-gray-600 flex items-center">
      <input class="w-full bg-white h-10 px-5 rounded-lg text-sm focus:outline-none"
        type="text" placeholder="Type a message">
      <form action="/api/messages" method="post">
        <button class="text-sm bg-indigo-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">Send</button>
      </form>
    </div>
  </div>
</main>
