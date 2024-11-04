<!doctype html>
<html lang="en">
<head>
    <title>#madewithtwill website</title>
</head>
<body>
<div>
    <div id="app"></div>
    <script src="{{ mix('/js/app.js') }}"></script>
    @yield('content')

</div>
<script>
    import { mapGetters } from 'vuex';

    export default {
        computed: {
            ...mapGetters(['getUser', 'isAdmin', 'isSuperAdmin', 'isDispatcher', 'isDriver']),
            user() {
                return this.getUser;
            },
            role() {
                return this.user ? this.user.role : '';
            }
        },
    };
</script>
</body>
</html>
