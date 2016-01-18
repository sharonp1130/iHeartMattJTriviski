package help.me.orm.dao;

/**
 * Basic interface to control all daos.
 * 
 * @author triviski
 *
 * @param <T>
 */
public interface IDao<T> {
	
	/**
	 * Persists the entity. 
	 * 
	 * @param entity
	 */
	public void save(T entity);
	
	/**
	 * Updates the entity. 
	 * 
	 * @param entity
	 */
	public void update(T entity);
	
	/**
	 * Deletes the entity.
	 * 
	 * @param entity
	 */
	public void delete(T entity);
	
	/**
	 * Mergeds the entity into the sessionFactory.  The entity will not be updated directly.
	 * 
	 * @param entity
	 */
	public T merge(T entity);
	/**
	 * Saves if the entity exists otherwise it updates.
	 * 
	 * @param entity
	 */
	public void saveOrUpdate(T entity);
	
	/**
	 * @param id
	 * @return
	 */
	public T findById(Integer id);
}
