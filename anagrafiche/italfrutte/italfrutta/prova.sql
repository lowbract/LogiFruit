ALTER TABLE nome_tabella_della_foreignkey
ADD FOREIGN KEY (nome_della_foreignkey) REFERENCES nome_tabella_primaria(nomeprimary_key_da_legare);


ALTER TABLE ordini
ADD FOREIGN KEY (idcliente) REFERENCES clienti (id);
ADD FOREIGN KEY (idazienda) REFERENCES aziende (idazienda);
