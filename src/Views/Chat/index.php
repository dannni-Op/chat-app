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
  <form method="get" class="pt-2 relative text-gray-600 mb-4">
    <input class="w-full border-2 border-gray-300 bg-white h-10 px-5 rounded-lg text-sm focus:outline-none" value="<?= $params['keyword'] ?? ''; ?>" type="search" name="name" placeholder="Search">
  </form>
  <div>
    <?php foreach($params["users"] as $user): ?>
    <a href="/chats/<?= $user->id; ?>" class="flex justify-between items-center mb-4">
      <div class="flex gap-4 items-center">
        <img class="w-12 rounded-full" src="images/<?= $user->image ?>" alt="profil" />
        <div>
          <p class="text-sm"><?= $user->firstname . " " . $user->lastname; ?></p>
          <p class="text-xs"><?= $user->status; ?></p>
        </div>
      </div>
      <div class="w-3 h-3 rounded-full <?= $user->status == 'online' ? 'bg-green-400' : 'bg-green-200' ?>"></div>
    </a>
    <?php endforeach; ?>
  </div>
</main>
<script>
</script>
