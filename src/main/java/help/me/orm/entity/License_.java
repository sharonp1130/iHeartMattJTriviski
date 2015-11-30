package help.me.orm.entity;

import java.util.Date;
import javax.annotation.Generated;
import javax.persistence.metamodel.SingularAttribute;
import javax.persistence.metamodel.StaticMetamodel;

@Generated(value="Dali", date="2015-11-27T22:31:41.878-0800")
@StaticMetamodel(License.class)
public class License_ {
	public static volatile SingularAttribute<License, Integer> licenseId;
	public static volatile SingularAttribute<License, User> user;
	public static volatile SingularAttribute<License, String> licenseNumber;
	public static volatile SingularAttribute<License, Service> service;
	public static volatile SingularAttribute<License, Date> createdAt;
	public static volatile SingularAttribute<License, Date> updatedAt;
}
