package help.me.orm.dao.impl;

import java.lang.reflect.ParameterizedType;
import java.util.ArrayList;
import java.util.Collection;

import javax.persistence.EntityManager;
import javax.persistence.PersistenceContext;

import org.hibernate.Session;

import help.me.orm.dao.IDao;

/**
 * All DAOs extend this class.  Need this because we are using annotations and
 * have to be able to autowire...not sure why when creating this but it was in
 * one of the mkyong tutorials.
 *
 * The stuff with the persistent class was taken from a jboss tutorial about generics and hibernate.
 * @author triviski
 *
 */
public abstract class CustomHibernateDAOSupport<T> implements IDao<T> {
	private Class<T> persistentClass;

	@PersistenceContext(name="cod-base")
	protected EntityManager entityManager;

	@SuppressWarnings("unchecked")
	public CustomHibernateDAOSupport() {
		super();

        this.persistentClass = (Class<T>) ((ParameterizedType) getClass()
                .getGenericSuperclass()).getActualTypeArguments()[0];
	}

//	@Autowired
//    public void autoWire(SessionFactory sessionFactory) {
//        setSessionFactory(sessionFactory);
//    }

    @Override
	public void save(T entity) {
    		entityManager.persist(entity);
	}

	@Override
	public void update(T entity) {
		merge(entity);
	}

	@Override
	public void delete(T entity) {
		entityManager.remove(entity);
	}

	@Override
	public T merge(T entity) {
		return (T) entityManager.merge(entity);
	}

	@Override
	public void saveOrUpdate(T entity) {
		if (entityManager.contains(entity)) { // Do an update.
			update(entity);
		} else { // Do a persist.
			save(entity);
		}
	}

	@Override
	public T findById(Integer id) {
		return(T) entityManager.find(persistentClass, id);
	}

	/**
	 * @return the current hibernate session
	 */
	public Session getCurrentSession() {
		return entityManager.unwrap(Session.class);
	}

	/**
	 * Convenience method to cast a list of results.
	 *
	 * @param resultsToCast data to cast.  This will fail if the data is
	 * not a list of type T.
	 * @return new collection with data cast as T.
	 */
	@SuppressWarnings("unchecked")
	protected Collection<T> castCollection(Collection<?> resultsToCast) {
		ArrayList<T> results = new ArrayList<T>();

		for (Object o : resultsToCast) {
			results.add((T) o);
		}


		return results;



	}
}
