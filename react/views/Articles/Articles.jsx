import { useEffect, useState } from "react";
import axiosClient from "../../src/axios-client.js";
import { Link } from "react-router-dom";

export default function ArticlesList() {
  const [articles, setArticles] = useState([]);
  const [loading, setLoading] = useState(false);

  useEffect(() => {
    getArticles();
  }, []);

  const getArticles = async () => {
    try {
      setLoading(true);
      const response = await axiosClient.get("/v1/articles");
      console.log("Response:", response.data);


      setArticles(response.data);
    } catch (error) {
      console.error("Error fetching articles:", error);
    } finally {
      setLoading(false);
    }
  }
  const onDelete = article =>{
    if(! window.confirm("Are you sure you want to delete this article?")){
      return;
    }
    axiosClient.delete(`/v1/articles/${article.id}`)
      .then(() => {
        // Notification
        getArticles();
      })
  }

  return (
    <div>
      <div style={{ display: "flex", justifyContent: "space-between", alignItems: "center" }}>
        <h1>Articles</h1>
        <Link to="/articleList/create" className="btn-add">
          Add Article
        </Link>
      </div>

      <div className="card animated fadeInDown">
          <table>
            <thead>
            <tr>
              <th>Title</th>
              <th>Slug</th>
              <th>Create Date</th>
              <th>Actions</th>
            </tr>
            </thead>
            {loading &&
              <tbody>
              <tr>
                <td colSpan="4" className="text-center">
                  Loading...
                </td>
              </tr>
              </tbody>
            }
            {!loading &&
            <tbody>
            {articles
              .map(article => (
                <tr key={article.id}>
                  <td>{article.attribute.title}</td>
                  <td>{article.attribute.slug}</td>
                  <td>{article.attribute.created_at}</td>
                  <td>
                    <Link className="btn-edit" to={`/articleList/${article.id}`} >Edit</Link>
                    &nbsp;
                    <button onClick={ev => onDelete(article)} className="btn-delete">Delete</button>
                  </td>
                </tr>
              ))
            }
            </tbody>
            }
          </table>

      </div>
    </div>
  );
}
