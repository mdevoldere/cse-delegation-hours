import { Ajax } from './js/ajax.js';

class CseUser
{
    constructor() {
        this.logout();
    }

    login(_o) {
        Object.assign(this, _o);

        if(this.titular === true) {
            this.hours = 22;
        } else {
            this.hours = 11;
        }

        let d = new Date(this.elected);
        this.electedFr = d.toLocaleDateString();
        d.setFullYear(d.getFullYear() + 4);
        this.expire = d.toLocaleDateString('fr-CA');
        this.expireFr = d.toLocaleDateString();
        this.setHours();
    }

    logout() {
        this.username = null;
        this.admin = false;
        this.elected = '0000-00-00';
        this.electedFr = '00/00/0000';
        this.expire = '0000-00-00';
        this.titular = true;
        this.hours = 0;
        this.month = [];
    }

    setHours() {
        let s = new Date(this.elected);
        let e = new Date(this.expire);
        while(s <= e) {
            //this.month.push(s.toLocaleDateString('fr-FR'));
            this.month.push((('0' + (s.getMonth())).slice(-2)) + '/' + s.getFullYear());

            s.setMonth(s.getMonth() + 1);
            if(s.getMonth() == 0) {
                s.setMonth(s.getMonth() + 1);
            }            
        }
    }
}

const app = {
    components: {
        
    },
    data() {
        return {
            view: 'home',
            credentials: { username: null, password: null },
            usr: new CseUser(),
            members: []
        }
    },

    async created() {
        let username = localStorage.getItem('u');

        if(username !== null) {
            let r = await Ajax.get('./api/users.php?u=' + username, true);

            if(r.error) {
                alert(r.error);
            } else {
                this.usr.login(r);
                this.getUsers();
            }
        }
    },
    
    computed: {
        
    },

    methods: {
        goto(e) {
            this.view = e.target.dataset.view;
        },
        async login() {
            let r = await Ajax.post('./api/account.php', this.credentials);

            if(r.error) {
                alert(r.error);
            } else {
                this.usr.login(r);
                localStorage.setItem('u', this.usr.username);
                this.getUsers();
            }
        },
        logout() {
            this.usr.logout();
            localStorage.clear();
        },
        async getUsers() {
            this.members = [];
            let r = await Ajax.get('./api/users.php', true);

            if(r.error) {
                alert(r.error);
            } else {
                console.log(r);
                for(let m of r) {
                    let c = new CseUser();
                    c.login(m);
                    this.members.push(c);
                }

                this.members.sort((a, b) => {
                    // true values first
                    return (a.titular === b.titular) ? 0 : a.titular ? -1 : 1;
                    // false values first
                    // return (x === y)? 0 : x? 1 : -1;
                });
            }
        }
    }
}

Vue.createApp(app).mount('#app');
