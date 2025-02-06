import { Section } from "./styles";
export interface ICard {
  nome: string
  marca: string
  sabor: string
  comentario: string
}
export const Card = ({ nome, marca, sabor, comentario  }: ICard) => {
  return (
    <Section>
      <aside>
        <h5>Nome:</h5>
        <p>{nome}</p>
      </aside>
      <aside>
        <h5>Marca:</h5>
        <p>{marca}</p>
      </aside>
      <aside>
        <h5>Sabor:</h5>
        <p>{sabor}</p>
      </aside>
      <aside>
        <h5>Comentário:</h5>
        <p>{comentario}</p>
      </aside>
    </Section>
  );
};
