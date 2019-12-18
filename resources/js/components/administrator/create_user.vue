<template>
    <div>
        <navbar/>
        <div class="inside_content">
            <div class="content_title">
                Create a new user
            </div>
            <form class="container">
                <div class="card">
                    <div class="card-header">
                        Information about the expense
                    </div>
                    <div class="card-body" >
                        <div style="margin-right: 150px; margin-left: 150px;">
                            <div class="form-group">
                                <label for="typeOfUser" class="font-weight-bold">Type of User</label>
                                <select id="typeOfUser" name="type" class="form-control">
                                    <option value="" disabled selected>----Select a type----</option>
                                    <option value="o" >Operator</option>
                                    <option value = "a">Administrator</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Name:</label>
                                <input type="text" class="form-control" placeholder="user@example.com">
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Email:</label>
                                <input type="email" name="email" class="form-control" placeholder="user@example.com">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Photo:</label>
                                <input type="file" class="form-control" name="photo">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Password:</label>
                                <input type="password" name="password" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Password Confirmation:</label>
                                <input type="email" name="passwordConfirmation" class="form-control" >
                            </div>


                            <div class="form-group" style="text-align: center;">
                                <input type="submit" class="btn btn-success">
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button  class="btn btn-danger">Cancel</button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "create_user"
    }
</script>

<style scoped>

</style>
