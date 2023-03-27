<?php
require('main/header.php');
require_once('app/models/Comment.php');
$comment = new Comment();
$comments = $comment->getAll();
?>
<main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900">
    <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
        <article class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
            <header class="mb-4 lg:mb-6 not-format">
                <address class="flex items-center mb-6 not-italic">
                    <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                        <img class="mr-4 w-16 h-16 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="Jese Leos">
                        <div>
                            <a href="#" rel="author" class="text-xl font-bold text-gray-900 dark:text-white">Jese Leos</a>
                            <p class="text-base font-light text-gray-500 dark:text-gray-400">Graphic Designer, educator & CEO Flowbite</p>
                            <p class="text-base font-light text-gray-500 dark:text-gray-400"><time pubdate datetime="2022-02-08" title="February 8th, 2022">Feb. 8, 2022</time></p>
                        </div>
                    </div>
                </address>
                <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">Best practices for successful prototypes</h1>
            </header>
            <p class="lead">Flowbite is an open-source library of UI components built with the utility-first
                classes from Tailwind CSS. It also includes interactive elements such as dropdowns, modals,
                datepickers.</p>
            <p>Before going digital, you might benefit from scribbling down some ideas in a sketchbook. This way,
                you can think things through before committing to an actual design project.</p>
            <p>But then I found a <a href="https://flowbite.com">component library based on Tailwind CSS called
                    Flowbite</a>. It comes with the most commonly used UI components, such as buttons, navigation
                bars, cards, form elements, and more which are conveniently built with the utility classes from
                Tailwind CSS.</p>
        </article>
    </div>
</main>
<article class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
    <section class="not-format">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Discussion</h2>
        </div>
        <form class="mb-6" action="/add_comment" id="add_comment" method="POST">
            <div>
                <label for="hs-leading-icon" class="block text-sm font-medium mb-2 dark:text-white">Name</label>
                <div class="relative">
                    <input type="text" id="hs-leading-icon" name="name" class="py-3 px-4 pl-11 block w-full border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" placeholder="Your Name" required>
                </div>
            </div>
            <div>
                <label for="hs-leading-icon" class="block text-sm font-medium mb-2 dark:text-white">Email address</label>
                <div class="relative">
                    <input type="email" id="hs-leading-icon" name="email" class="py-3 px-4 pl-11 block w-full border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" placeholder="you@site.com" required>
                </div>
            </div>
            <div>
                <label for="hs-leading-icon" class="block text-sm font-medium mb-2 dark:text-white">Title</label>
                <div class="relative">
                    <input type="text" id="hs-leading-icon" name="title" class="py-3 px-4 pl-11 block w-full border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400" placeholder="Title" required>
                </div>
            </div>
            <label for="description" class="block text-sm font-medium mb-2 dark:text-white">Comment</label>
            <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <textarea id="description" name="description" rows="6" class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 dark:text-white dark:placeholder-gray-400 dark:bg-gray-800" placeholder="Write a comment..." required></textarea>
            </div>
            <button type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                Comment
            </button>
        </form>
        <div id="comments_section">
            <?php foreach ($comments as $comment): ?>
            <article id="comment-<?php echo $comment['id'] ?>" class="p-6 mb-6 text-base bg-white rounded-lg dark:bg-gray-900">
                <footer class= mb-2">
                    <div >
                        <p class="mr-3 text-sm text-gray-900 dark:text-white"><?= $comment['name'] ?></p>
                        <p class="text-sm text-gray-600 dark:text-gray-400"><?= $comment['email'] ?></p>
                        <p class="text-sm text-gray-600 dark:text-gray-400"><?= $comment['created_at'] ?></p>
                    </div>
                </footer>

                <h3><?= $comment['title'] ?></h3>
                <p class="text-gray-500 dark:text-gray-400"><?= $comment['description'] ?></p>
                <div class="flex items-center mt-4 space-x-4">
                    <button data-id="<?= $comment['id'] ?>"  class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md delete-comment">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete
                    </button>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </section>
</article>
<?php include('main/footer.php') ?>
<script>
    $(document).ready(function() {
        $('#add_comment').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: '/add_comment',
                type: 'POST',
                data: formData,
                success: function(response) {
                   var data = JSON.parse(response)
                    $('#comments_section').append(`<article id="comment-${data.data.id}" class="p-6 mb-6 text-base bg-white rounded-lg dark:bg-gray-900">
                <footer class= mb-2">
                    <div >
                        <p class="mr-3 text-sm text-gray-900 dark:text-white">${data.name}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">${data.email}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">${data.data.created_at}</p>
                    </div>
                </footer>

                <h3>${data.title}</h3>
                <p class="text-gray-500 dark:text-gray-400">${data.description}</p>
                <div class="flex items-center mt-4 space-x-4">
                    <button data-id="${data.data.id}"  class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md delete-comment">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete
                    </button>
                </div>
            </article>`)

            $('#add_comment')[0].reset();
                },
                error: function(error) {
                    console.log(error)
                }
            });
        });
        $('#comments_section').on('click', '.delete-comment', function() {
            var commentId = $(this).data('id');
            $.ajax({
                method: 'POST',
                url: '/delete_comment',
                data: { commentId: commentId },
                success: function(response) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Comment Deleted Successfully',
                        icon: 'success',
                    });
                    $('#comment-'+commentId).remove();
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Error!',
                        text: error,
                        icon: 'error',
                    });
                }
            });
        });
    });
</script>


