4.2 Pontos de estudo(
• O que charset=utf8mb4?
• O que muda com PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION?
1-Bom basicamente, ele serve para o SQL entender caracteres reecentes como por exemplo emojis e etc,
sem ele caso um usario comente um emoji em um site por exemplo que não contem o  charset=utf8mb4
mas sim a versão mais antiga, ele reportará um erro!

2-De froma simples ele serve para te alertar que ouve um erro no banco de dados, ja que sem ele, o php
percebe o erro mas "gaurda para ele", fica calado e por isso você teria que verificar manualmente
se houve um erro.

)



