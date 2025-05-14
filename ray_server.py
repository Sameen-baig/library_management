import ray
from ray import serve
from fastapi import FastAPI, Request
import pymysql

# Initialize Ray and Serve
ray.init(address="auto", ignore_reinit_error=True)
serve.start(detached=True)

# Database connection function
def get_db_connection():
    return pymysql.connect(
        host='localhost',
        user='root',
        password='',
        db='library_management'
    )

@ray.remote
def process_add_book(data):
    try:
        conn = get_db_connection()
        with conn.cursor() as cur:
            cur.execute(
                "INSERT INTO book (bookpic, bookname, bookdetail, bookaudor, bookpub, branch, bookprice, bookquantity, bookava, bookrent) "
                "VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",
                (data['bookphoto'], data['bookname'], data['bookdetail'], data['bookaudor'],
                 data['bookpub'], data['branch'], data['bookprice'], data['bookquantity'],
                 data['bookquantity'], 0)
            )
            conn.commit()
        conn.close()
        return {"status": "added", "bookname": data['bookname']}
    except Exception as e:
        return {"status": "error", "message": str(e)}

# Create FastAPI app
app = FastAPI()

@app.post("/addbook")
async def addbook(request: Request):
    data = await request.json()
    result_ref = process_add_book.remote(data)
    result = ray.get(result_ref)  # This will get the result from the remote function
    return result

# Define deployment with Serve
@serve.deployment
@serve.ingress(app)
class BookService:
    pass  # app routes are already registered

# Deploy the service using serve.run() (instead of BookService.deploy())
serve.run(BookService.bind(), route_prefix="/")
