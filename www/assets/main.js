class CseUser
{
    constructor() {
        this.login = "MDevoldere";
        this.admin = false;
    }
}

const app = {
    components: {
        
    },
    data() {
        return {
            usr: new CseUser()
        }
    },

    async created() {
        
    },
    
    computed: {
        
    },

    methods: {
        
    }
}

Vue.createApp(app).mount('#app');
