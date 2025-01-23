import { Ajax } from './js/ajax.js';

class CseUser
{
    constructor() {
        this.username = null;
        this.admin = false;
        this.elected = '0000-00-00';
        this.titular = true;
    }

    login(_o) {
        Object.assign(this, _o);
    }
}

const app = {
    components: {
        
    },
    data() {
        return {
            credentials: { username: null, password: null },
            usr: new CseUser()
        }
    },

    async created() {
        
    },
    
    computed: {
        
    },

    methods: {
        async login() {
            console.log(this.credentials);
            let r = await Ajax.post('./api/account.php', this.credentials);

            if(r.error) {
                alert(r.error);
            } else {
                this.usr.login(r);
                localStorage.setItem('username', this.usr.username)
            }
            
        }
    }
}

Vue.createApp(app).mount('#app');
