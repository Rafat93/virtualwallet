
export default function() {
    function isAdministrator() {
        let user;
        axios.get('api/users/me',{'headers': {'Authorization': 'Bearer '+this.$store.state.token}})
            .then(response=>{user = response.data.data});
        if (user.type == 'a'){
            return true;
        }else {
            return false;
        }
    }

    function isOperator() {

    }
}
