import styled from "styled-components"

import { colors } from "../../styles/GlobalStyle"

export const SHeader = styled.header`
  /* Cabeçalho */
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 0.5rem solid ${colors.secondary};
  height: 5rem;
  figure {
    display: flex;
    align-items: left;
    justify-content: center;
    height: 100px;
    width: 200px;
    img {
      height: 100px;
      width: 200px;
      display: flex;
      align-items: left;
      justify-content: center;
      
    }
  }
`

export const SNavBar = styled.nav`
  /* Navegação */
  display: flex;
  align-items: center;
  a {
    margin: 0 1rem;
    text-decoration: none;
    color: ${colors.black};
  }
  a:hover {
    font-weight: bold;
  }
`