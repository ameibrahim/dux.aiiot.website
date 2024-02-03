let listOfUsersContainer = document.querySelector(".list-of-users");

function fetchTeachers(inputElement) { 

    let result = new Promise((resolve,reject) => {
        // TODO: XSS vulnerability 
        // inputElement.value is not wrapped or regex tested.
        if(inputElement.value != ""){
            let params = `Name=${inputElement.value}`;
            let xhr = new XMLHttpRequest();

            xhr.open("POST", "teacher-name.fetch.php", true);

            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onload = function(){
                let users;
                if( this.status == 200 ){
                    users = JSON.parse(this.responseText);

                    if(users.length != 0) resolve(users);
                    else {
                        listOfUsersContainer.style.display = 'none';
                    }
                }
                else reject("Error Fetching Users");
            } 
            xhr.send(params);
        }
        else{ listOfUsersContainer.style.display = 'none'; }
    });

    result.then( data => listAvailableUsers(data) );

}

function listAvailableUsers(array){
    let usersHTML = ``;
    array.forEach( () => usersHTML += `<div class="searched-user-item" onclick="setName(this)">Hello</div>` );
    // array.forEach( object => usersHTML += `<div class="searched-user-item" onclick="setName(this)" data-name="${object['Name']}" data-id=${object['ID']}>${object['Name']}</div>` );
    listOfUsersContainer.innerHTML = usersHTML;
    listOfUsersContainer.style.display = 'block';
}