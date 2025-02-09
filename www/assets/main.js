import { Ajax } from './js/ajax.js';

class CseUser
{
    constructor() {
        this.logout();
    }

    getDateStart() {
        return this.date_start.toLocaleDateString('fr-FR');
    }

    getDateEnd() {
        return this.date_end.toLocaleDateString('fr-FR');
    }

    login(_o) {
        Object.assign(this, _o);

        this.hours = (this.m_titular === 1) ? 22 : 11;

        this.date_start = new Date(this.m_actual_start); 

        if(this.m_actual_end !== "") {
            this.date_end = new Date(this.m_actual_end);
        } else {
            this.date_end = new Date(this.m_end);
        }
        
        this.setHours();
        console.log(this);
    }

    logout() {
        this.id = null;
        this.adm = false;
        this.hours = 0;
        this.month = [];
    }

    setHours() {
        let s = new Date(this.date_start);
        s.setMonth(s.getMonth()+1);
        //console.log(s.getMonth());
        let e = new Date(this.date_end);
        while(s <= e) {
            //this.month.push(s.toLocaleDateString('fr-FR'));
            this.month.push((('0' + (s.getMonth()+1)).slice(-2)) + '/' + s.getFullYear());

            s.setMonth(s.getMonth() + 1);
          
        }
    }
}

class DelegationHours 
{
    constructor(uid, year, month) {
        this.uid = uid;
        this.date = new Date('');
    }
}

class Delegation 
{
    constructor() {
        
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
            let r = await Ajax.post('./api/login.php', this.credentials);

            if(r.error) {
                alert(r.error);
            } else {
                this.usr.login(r);
                localStorage.setItem('u', this.usr.id);
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
