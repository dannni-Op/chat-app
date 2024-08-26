<main class="sm:mx-auto sm:w-full sm:max-w-sm h-screen border px-6 py-12 lg:px-8">
    <div class="flex justify-between items-center mb-5">
        <div class="flex items-center gap-4" >
	    <img class="w-12 rounded-full" src="images/<?= $params["user"]->image ?>" alt="profil" />
	    <div class="" >
                <p class="text-sm text-center"><?= $params["user"]->firstname . " " . $params["user"]->lastname?></p>
                <p class="text-xs "><?= $params["user"]->status ?></p>
            </div>
        </div>
        <form action="/api/auth/logout" method="post">
            <button class="text-sm bg-indigo-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">Logout</button>
        </form>
    </div>
    <div class="pt-2 relative text-gray-600 mb-4">
        <input class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
          type="search" name="search" placeholder="Search">
        <button type="submit" class="absolute right-0 top-0 mt-5 mr-4">
          <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
            viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
            width="512px" height="512px">
            <path
              d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
          </svg>
        </button>
    </div>
    <div>
        <?php foreach($params["users"] as $user): ?>
        <a href="/chats/1" class="flex justify-between items-center mb-4">
            <div class="flex gap-4 items-center">
		        <img class="w-12 rounded-full" src="images/<?= $user['image'] ?>" alt="profil" />
                <div>
                    <p class="text-sm"><?= $user["firstname"] . " " . $user["lastname"]; ?></p>
                    <p class="text-xs"><?= $user["status"]; ?></p>
                </div>
            </div>
            <div class="w-3 h-3 rounded-full <?= $user["status"] == 'online' ? 'bg-green-400' : 'bg-green-200' ?>"></div>
        </a>
        <?php endforeach; ?>
    </div>
</main>
