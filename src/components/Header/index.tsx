import { Link } from "react-router-dom"
import { SHeader, SNavBar } from "./styles"
import Logo from "../../assets/logo.png"
import { useContext } from "react";
import { AuthContext } from "../../contexts/authContext";
import { GrLogout } from "react-icons/gr";
export function Header() {
  const { user, signOut } = useContext(AuthContext)
  async function logout() {
    await signOut()
  }
  return (
    <SHeader>
      <a href="https://elmachips.com.br/" target="_blank"> 
      <figure>
        <img src={Logo} alt="Logo do site" />
      </figure>
      </a>
      <SNavBar>
        <Link to="/">Início</Link>
        <Link to="/comentario">Comentário</Link>
        {
          user ? (
            <>
              <Link to="/adm">Administrativa</Link>
              <button onClick={logout}>{user.nome} <GrLogout /></button>
            </>
          ) : (
            <>
              <Link to="/login">Login</Link>
              <Link to="/cadastrar">Cadastrar</Link>
            </>
          )
        }
      </SNavBar>
    </SHeader>
  )
}