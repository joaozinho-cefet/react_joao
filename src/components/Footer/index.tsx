import { SFooter } from "./styles"
import Insta from "../../assets/insta.png"

export function Footer() {
  return (
    <SFooter>
      <a href="https://www.instagram.com/elmachipsbrasil?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank">
        <img src={Insta} alt="Instagram" />
      </a>
    </SFooter>
  )
}