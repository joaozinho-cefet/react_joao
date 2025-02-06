import { Section } from './styles'
import img1 from "../../assets/lanchinho.webp"
import img2 from "../../assets/lanchinhos2.jpeg"


export function Home() {
  return (
    <Section>
      <img src={img1} alt="IMG na esquerda" />
      <img src={img2} alt="IMG na direita" />
    </Section>
  )
}
