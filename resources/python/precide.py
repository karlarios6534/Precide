from fastapi import FastAPI
from fastapi.responses import HTMLResponse
import pandas as pd
from fastapi.encoders import jsonable_encoder
#manipulacion de datos
import pandas as pd
from sklearn.preprocessing import StandardScaler
#visializacion de datos
from sklearn.decomposition import PCA
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import LabelEncoder
from sklearn.linear_model import LogisticRegression
app = FastAPI()

@app.get("/hola/{nombre}")
async def hola(nombre:str):
    #df = pd.read_csv("C:/Users/gdlkrios/Desktop/ejercicios/doc.csv", engine='python')
    #dat = df.iloc[0,0]

    pd.set_option('display.max_columns',None)
    df = pd.read_csv('C:/Users/Damian Wayne/Desktop/pm/data.csv')
    df.head()

    #eliminacion de columnas que no necesitaremos
    df=df.drop(['id' , 'Unnamed: 32'] , axis=1)

    #transformar la clase en variable numerica

    le = LabelEncoder()

    df['diagnosis'] = le.fit_transform(df['diagnosis'])
    df.head()


    scaler = StandardScaler()

    scaler.fit(df)
    scaled_data = scaler.transform(df)



    pca = PCA(n_components=2)
    pca.fit(scaled_data)
    x_pca = pca.transform(scaled_data)

    #dividir datos en etiquetas
    X = df.drop('diagnosis', axis = 1)
    y = df['diagnosis']



    #split data

    X_train, X_test, y_train, y_test = train_test_split(X, y, test_size = 0.2, random_state = 42)
    print('Shape of train set ', X_train.shape)
    print('Shape of test set ', X_test.shape)

    LR = LogisticRegression()

    #entrenar al modelo 
    LR.fit(X_train,y_train)

    #predicciones
    Y_LR = LR.predict(X_test)

    pacientenuevo = pd.DataFrame({"num1":[18.49,17.52,121.3,1068,0.1012,0.1317,0.1491,0.09183,0.1832,0.06697,0.7923,1.045,4.851,95.77,0.007974,0.03214,0.04435,0.01573,0.01617,0.005255,22.75,22.88,146.4,1600,0.1412,0.3089,0.3533,0.1663,0.251,0.09445]})
    #print(LR.predict(pacientenuevo.T))
    resultado = str(LR.predict(pacientenuevo.T))

    data = {'nombre': nombre, 'resultado': resultado}
    response = jsonable_encoder(data)
    return response
    # table = df.to_html()
    # suma = 'hole'
    # titulo="titulo de pagina"
    # html = f'''
    #             <!DOCTYPE html>
    #             <html>
    #                 <head>
    #                     <title>{{titulo}}</title>
    #                 </head>
    #                 <body>
    #                     <table>{{table}}</table>
    #                 </body>
    #             </html>
    #         '''
    # html = html.format(suma=suma, titulo=titulo, table=table)

    #return HTMLResponse(content=html, status_code=200)
 
if __name__ == "__main__":
    import uvicorn
    uvicorn.run(app, host="localhost", port=8001)