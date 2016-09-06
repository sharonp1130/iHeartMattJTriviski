package help.me.orm.bo;

import org.apache.log4j.Logger;

import help.me.orm.dao.IDao;

public interface IBo<T> {
	/**
	 * This value should be used when doing queries if no max results is given.  If 
	 * we don't do this an outside force could spam the server by requesting everything 
	 * which at some point will be a huge number of values.
	 */
	static final int RESULT_UPPER_LIMIT = 30;
	
	static Logger log = Logger.getLogger(IBo.class);

	public IDao<T> getDao();
	
	/**
	 * Persists the entity. 
	 * 
	 * @param entity
	 */
	public default void save(T entity) {
		getDao().save(entity);
	}
	
	/**
	 * Updates the entity. 
	 * 
	 * @param entity
	 */
	public default void update(T entity) {
		getDao().update(entity);
	}
	
	/**
	 * Deletes the entity.
	 * 
	 * @param entity
	 */
	public default void delete(T entity) {
		getDao().delete(entity);
	}
	
	/**
	 * Merge the entity.
	 * @param entity
	 * @return
	 */
	public default T merge(T entity) {
		return getDao().merge(entity);
	}
	
	/**
	 * @param user
	 */
	public default void saveOrUpdate(T entity) {
		getDao().saveOrUpdate(entity);
	}

	/**
	 * Finds the entity by the id.
	 * 
	 * @param id
	 * @return
	 */
	public default T findById(Integer id) {
		return getDao().findById(id);
	}
}
