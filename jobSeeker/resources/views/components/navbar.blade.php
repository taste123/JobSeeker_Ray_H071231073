<div class="nav">
    <button id="menuToggle"><i class="bx bx-menu"></i></button>
    <div class="search">
        <form action="{{ route('dashboard') }}" method="GET" class="search-form">
            <div class="searchbar">
                <i class="bx bx-search"></i>
                <input type="text" name="query" placeholder="Search for job or companies" value="{{ request('query') }}" />
                <button type="submit" class="search-button">Search</button>
            </div>
        </form>
    </div>
    <div class="userInfo">
        @auth
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }} <i class="bx bx-chevron-down"></i>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">View Profile</a>
                    <form method="POST" action="{{ route('logout') }}" class="dropdown-item">
                        @csrf
                        <button type="submit" class="btn-link">Logout</button>
                    </form>
                </div>
            </div>
        @else
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Login/Register <i class="bx bx-chevron-down"></i>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                    <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                </div>
            </div>
        @endauth
    </div>
</div>

<style>
    .nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 20px;
}

.search {
    /* flex: 1; */
    /* display: flex; */
    /* justify-content: center; */
}

.search-form {
    display: flex;
    align-items: center;
    width: 100%;
    max-width: 1000px;
}

.searchbar {
    display: flex;
    align-items: center;
    flex: 1;
    border-radius: 15px;
    padding: 5px 10px;
    background-color: #f2f2f2;
}

.searchbar i {
    margin-right: 10px;
    color: #888;
}

.searchbar input {
    flex: 1;
    border: none;
    background: none;
    outline: none;
    padding: 10px;
    font-size: 14px;
}

.search-button {
    background-color: #2e4cad;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-left: 10px;
}

.search-button:hover {
    background-color: #1d3a8a;
}

.userInfo {
    display: flex;
    align-items: center;
}

.dropdown {
    position: relative;
}

.dropdown-toggle {
    display: flex;
    align-items: center;
    cursor: pointer;
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    right: 0;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    display: none;
    flex-direction: column;
    z-index: 1000;
}

.dropdown:hover .dropdown-menu {
    display: flex;
}

.dropdown-item {
    padding: 10px 20px;
    cursor: pointer;
    text-decoration: none;
    color: #333;
}

.dropdown-item:hover {
    background-color: #f2f2f2;
}

.btn-link {
    background: none;
    border: none;
    padding: 0;
    color: #333;
    cursor: pointer;
    text-decoration: none;
}
</style>