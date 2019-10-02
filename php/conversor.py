import pandas as pd

print("Digite o endereco do arquivo .json (com extensao): ")
json = input()
print("Digite o endereco do arquivo .xls que sera gerado (com extensao): ")
xls = input()


pd.read_json(json).to_excel(xls)