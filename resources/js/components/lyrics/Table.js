import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import Remove from '../Delete'

function DataTable(props) {
    const [lyrics, setLyrics] = useState([])
    const [url, setUrl] = useState(props.endpoint)
    const [links, setLinks] = useState([])
    const [bandId, setBandId] = useState('')
    const [albumId, setAlbumId] = useState('')
    const [bands, setBands] = useState([])
    const [albums, setAlbums] = useState([])
    const filterRecord = { band_id: bandId, album_id: albumId }

    const getLyrics = async () => {
        try {
            // cara 1
            let response = await axios.get(url, { params: filterRecord });
            setLyrics(response.data.data);
            response.data.meta ? setLinks(response.data.meta.links) : setLinks([])
            
            // cara 2 (karena jsx) tetapi tidak recommend karena langsung direct ke props yang dituju
            /* let {data} = await axios.get(url);
            console.log(data.data); */

        } catch (e) {
            console.log(e.message);
        }
    }

    const getBands = async () => {
        let response = await axios.get('/bands/table')
        setBands(response.data);
    }

    const getAlbumBySelectedBand = async (e) => {
        setBandId(e.target.value)
        let response = await axios.get(`/albums/get-album-by-${ e.target.value }`)
        setAlbums(response.data);
    }

    const filter = (e) => {
        e.preventDefault();
        getLyrics();
    }

    useEffect(() => {
        getBands()
        getLyrics()
    }, [ url, bandId, albumId ]) /* merubah secara langsung tampilan ketika band dipilih begitujuga albumnya juga reload */

    return (
        <div>
            <div className="row mb-3">
                <div className="col-md-6">
                    <form className="d-flex" onSubmit={filter}>
                        <select onChange={ getAlbumBySelectedBand } name="band" id="band" className="form-control mr-2">
                            <option value="">Select Band</option>
                            {
                                bands.map((band) => 
                                    <option key={band.id} value={band.id}>{band.name}</option>
                                )
                            }
                        </select>
                        <select value={albumId} onChange={(e) => setAlbumId(e.target.value)} name="album" id="album" className="form-control mr-2">
                            <option value="">Select Album</option>
                            {
                                albums.map((album) => 
                                    <option key={album.id} value={album.id}>{album.name}</option>
                                )
                            }
                        </select>
                        <button type="submit" className="btn btn-primary">Go</button>
                    </form>
                </div>
            </div>
            <div className="card">
                <div className="card-header">
                    { props.title }
                </div>
                    <div className="card-body">
                        <table className="table table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Band</th>
                                    <th>Album</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                {
                                    lyrics.map((lyric) => {
                                        return (
                                            <tr key={ lyric.id }>
                                                <td>{ lyric.title }</td>
                                                <td>{ lyric.body }</td>
                                                <td>{ lyric.album }</td>
                                                <td className="d-flex align-item-center">
                                                    <a className="btn btn-sm btn-primary mr-2" href={`/lyrics/${lyric.slug}/edit`}>Edit</a>
                                                    <div>
                                                        <Remove endpoint={`/lyric/${lyric.slug}/delete`} />
                                                    </div>
                                                </td>
                                            </tr>
                                        )
                                    })
                                }
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul className="pagination">
                                {
                                    links.map((link, index) => {
                                        return(
                                            <li className={`page-item ${link.active ? 'active' : ''}`} key={index}>
                                                <button onClick={(e) => setUrl(link.url)} className="page-link">{ link.label }</button>
                                            </li>
                                        )
                                    })
                                }
                            </ul>
                        </nav>
                    </div>
                </div>
        </div>
    );

}

export default DataTable;

if (document.getElementById('table-of-lyric')) {
    const item = document.getElementById('table-of-lyric')
    ReactDOM.render(<DataTable title = { item.getAttribute('title') } endpoint = { item.getAttribute('endpoint') }/>, item);
}
