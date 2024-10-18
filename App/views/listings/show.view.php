<?php loadPartial('head');?>
<?php loadPartial('navbar');?>
<?php loadPartial('top-banner');?>

    <section class="container mx-auto p-4 mt-4">
      <div class="rounded-lg shadow-md bg-white p-3">
       <div class="flex justify-between items-center">
      <a class="block p-4 text-blue-700" href="/listings">
        <i class="fa fa-arrow-alt-circle-left"></i>
        返回列表
      </a>
      <div class="flex space-x-4 ml-4">
        <a href="/edit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded">编辑</a>
        <!-- 删除表单 -->
        <form method="POST">
          <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">删除</button>
        </form>
        <!-- 删除表单结束 -->
      </div>
    </div>
        <div class="p-4">
          <h2 class="text-xl font-semibold"><?= $listing->title?></h2>
          <p class="text-gray-700 text-lg mt-2">
          <?= $listing->description ?>
          </p>
          <ul class="my-4 bg-gray-100 p-4">
            <li class="mb-2"><strong>薪资:</strong> ¥<?= $listing->salary ?></li>
            <li class="mb-2">
              <strong>地点:</strong><?= $listing->city ?>
            </li>
            <li class="mb-2">
              <strong>标签:</strong> <?= $listing->tags ?>
            </li>
          </ul>
        </div>
      </div>
    </section>

    <section class="container mx-auto p-4">
      <h2 class="text-xl font-semibold mb-4">职位详情</h2>
      <div class="rounded-lg shadow-md bg-white p-4">
        <h3 class="text-lg font-semibold mb-2 text-blue-500">
          职位要求
        </h3>
        <p>
        <?= $listing->requirements ?>
        </p>
        <h3 class="text-lg font-semibold mt-4 mb-2 text-blue-500">福利</h3>
        <p><?= $listing->benefits ?></p>
      </div>
      <p class="my-5">
        请在你的邮件主题中注明“职位申请”，并附上你的简历。
      </p>
      <a
        href="mailto:<?= $listing->email ?>"
        class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium cursor-pointer text-indigo-700 bg-indigo-100 hover:bg-indigo-200"
      >
        现在申请
      </a>
    
      </section>
      
<?php loadPartial('bottom-banner');?>
<?php loadPartial('footer');?>