import { Navigate, Outlet, Link } from "react-router-dom";
import { useStateContext } from "../contexts/ContextProvider.jsx";
import axiosClient from "../axios-client.js";
//import {useEffect} from "react";

export default function DefaultLayout() {
  const { user ,token,setUser,setToken } = useStateContext();
  if (!token) {
    return <Navigate to="/signin" />;
  }
const onLogout = (ev) =>{
    ev.preventDefault()
    axiosClient.post('/logout')
      .then(()=>{
        setUser({})
        setToken(null)
      })

}

  // useEffect(() => {
  //   axiosClient.get('/user').then(({ data }) => {
  //     setUser(data)
  //   });
  // }, [set]);

  return (
    <div id="defaultLayout">
      <aside>
        <Link to="/dashboard">Dashboard</Link>
        <Link to="/ArticleList">Article List</Link>
      </aside>
      <div className="content">
        <header>
          <div>Header</div>
          <div>
            {user.name}
            <a href="#" onClick={onLogout} className="btn-logout"> Logout</a>
          </div>
        </header>

        <main>
          <Outlet />
        </main>
      </div>
    </div>
  );
}
