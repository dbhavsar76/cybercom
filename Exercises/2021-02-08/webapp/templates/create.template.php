<div class="wrapper">
    <h1>Create Contact</h1>
    <hr>
    <form action="create.php" method="post">
        <div class="row">
            <div class="col">
                <label for="id">ID</label>
                <input type="number" name="id" id="id" value="1" class="" placeholder="ID" disabled>
                <p class="err-msg"></p>
            </div>
            <div class="col">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="" class="" placeholder="John Doe">
                <p class="err-msg"></p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="" class="" placeholder="johndoe@example.com">
                <p class="err-msg"></p>
            </div>
            <div class="col">
                <label for="id">Phone</label>
                <input type="number" name="phone" id="phone" value="" class="" placeholder="1234567890">
                <p class="err-msg"></p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="Title">Title</label>
                <input type="text" name="title" id="title" value="" class="" placeholder="Employee">
                <p class="err-msg"></p>
            </div>
            <div class="col">
                <label for="created">Created</label>
                <input type="datetime" name="created" id="created" value="" class="" placeholder="2021-01-01 01:01:01" disabled>
                <p class="err-msg"></p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input type="submit" value="Create" name="submit">
            </div>
        </div>
    </form>
</div>